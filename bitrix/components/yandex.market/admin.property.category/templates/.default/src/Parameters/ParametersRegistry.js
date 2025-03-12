import type {Transport} from "../Component/Transport";
import type {CategoryField} from "../CategoryField";
import {ParameterCollection} from "./Dto/ParameterCollection";
import type {Parameter} from "./Dto/Parameter";
import type {State} from "../Component/State";

export class ParametersRegistry {

	_parameters: ParameterCollection;
	_parametersPromise: Promise<ParameterCollection>;
	_parametersResolve;
	_itemWaiting = [];

	constructor(category: CategoryField, transport: Transport, state: State) {
		this.category = category;
		this.transport = transport;
		this.state = state;
	}

	initialLoad() : Promise {
		if (this._parameters != null) { return Promise.resolve(this._parameters); }

		return this.fetch();
	}

	loaded() : boolean {
		return this._parameters != null;
	}

	reset(parameterCollection: ParameterCollection) : void {
		this._parameters = parameterCollection;
		this.resolveWaiting();
		this.resolveFetch();
	}

	collection() : Promise<ParameterCollection> {
		if (this._parameters != null) { return Promise.resolve(this._parameters); }

		return this.fetch();
	}

	stopWait(id: number, callback: () => {}) : void {
		for (const index of this._itemWaiting.keys()) {
			const [waitingId, waitingCallback] = this._itemWaiting[index];

			if (waitingId === id && waitingCallback === callback) {
				this._itemWaiting.splice(index, 1);
				break;
			}
		}
	}

	wait(id: number, callback: () => {}) : void {
		if (this._parameters != null) {
			this.resolveWaitingItem(id, callback);
			return;
		}

		this._itemWaiting.push([ id, callback ]);
	}

	resolveWaiting() : void {
		for (const [id, callback] of this._itemWaiting) {
			this.resolveWaitingItem(id, callback);
		}

		this._itemWaiting = [];
	}

	resolveWaitingItem(id: number, callback: () => {}) : void {
		const parameter = this._parameters.item(id);

		if (parameter == null) { return; }

		callback(parameter);
	}

	item(id: number) : Promise<Parameter> {
		return this.collection()
			.then((parameterCollection: ParameterCollection) => {
				const item = parameterCollection.item(id);

				if (item == null) {
					throw new Error(`not found parameter {id}`);
				}

				return item;
			});
	}

	fetch() : Promise<ParameterCollection> {
		if (this._parametersPromise != null) { return this._parametersPromise; }

		this._parametersPromise = new Promise((resolve, reject) => {
			this._parametersResolve = resolve;
			this.state.loading();

			this.transport.fetch('parameters', {
				parentCategory: this.category.parentValue(),
				category: this.category.value(),
			})
				.then((data) => {
					this._parametersResolve = null;
					this._parametersPromise = null;
					this.state.waiting();
					this.reset(new ParameterCollection(data.parameters));
					resolve(this._parameters);
				})
				.catch((error: Error) => {
					this._parametersResolve = null;
					this._parametersPromise = null;
					this.state.error(error);
					reject();
				});
		});

		return this._parametersPromise;
	}

	resolveFetch() : void {
		if (this._parametersResolve == null) { return; }

		this._parametersResolve(this._parameters);
		this._parametersResolve = null;
		this._parametersPromise = null;
	}
}