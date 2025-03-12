import {CategoryField} from "./CategoryField";
import {ParametersField} from "./ParametersField";
import {Transport} from "./Component/Transport";
import {Locale} from "./Component/Locale";
import {Form} from "./Component/Form";
import {State} from "./Component/State";
import {ParameterCollection} from "./Parameters/Dto/ParameterCollection";
import {ParametersRegistry} from "./Parameters/ParametersRegistry";

// noinspection JSUnusedGlobalSymbols
export class CategoryPanel {

    static defaults = {
        transport: null,
	    language: 'ru',
	    locale: null,
	    form: null,
	    category: null,
        categoryElement: '[data-entity="category"]',
	    parameters: null,
        parametersElement: '[data-entity="parameters"]',
	    stateElement: '[data-entity="state"]',
    }

	_reloadTimeout;

	constructor(element: HTMLElement, options: Object = {}) {
		this.el = element;
		this.options = Object.assign({}, this.constructor.defaults, options);
		this.form = new Form(this.el.closest('form'), this.formOptions());
		this.locale = new Locale(this.options.locale, this.options.language);
		this.transport = new Transport(this.options.transport, this.form.apiKeyField());
		this.state = new State(element.querySelector(this.options.stateElement), this.locale);
		this.category = new CategoryField(element.querySelector(this.options.categoryElement), this.transport, this.locale, this.options.category);
		this.paramaters = new ParametersField(
			element.querySelector(this.options.parametersElement),
			new ParametersRegistry(this.category, this.transport, this.state),
			this.state,
			this.locale,
			this.parametersOptions(this.category)
		);

		this.category.handleChange(true, this.onCategoryChange);
		this.form.handleChange(true, this.onFormChange);
	}

	destroy() : void {
		clearTimeout(this._reloadTimeout);
		this.category.handleChange(false, this.onCategoryChange);
		this.form.handleChange(false, this.onFormChange);

		this.paramaters.destroy();
		this.category.destroy();
		this.form.destroy();
	}

	formOptions() : Object {
		const options = Object.assign({}, this.options.form);

		if (this.el.dataset.formPayload != null) {
			options['payload'] = JSON.parse(this.el.dataset.formPayload);
		}

		return options;
	}

	parametersOptions(category: CategoryField) : Object {
		const options = Object.assign({}, this.options.parameters);

		if (options.name == null) {
			options.name = category.selectElement().prop('name').replace(/\[CATEGORY]$/, '[PARAMETERS]');
		}

		return options;
	}

	onCategoryChange = () : void => {
		this.reload();
	}

	onFormChange = () : void => {
		this.reloadDelayed();
	}

	reloadDelayed() : void {
		clearTimeout(this._reloadTimeout);

		// noinspection JSUnresolvedReference
		if (window.JCIBlockGroupFieldIsRunning) { return; }

		this._reloadTimeout = setTimeout(() => this.reload(), 200);
	}

	reload() {
		clearTimeout(this._reloadTimeout);
		this.state.loading();

		this.transport.fetch('reload', {
			category: this.category.value(),
			form: this.form.transportPayload(),
		})
			.then((data: Object) : void => {
				this.category.resetParent(data.parentCategory);
				this.paramaters.reload(new ParameterCollection(data.parameters || []), data.parentParameters, !!this.category.value());
				this.state.waiting();
			})
			.catch((error: Error) : void => {
				this.state.error(error);
			});
	}
}