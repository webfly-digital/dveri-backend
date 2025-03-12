const BX = window.BX;

export class Transport {

	static defaults = {
		url: null,
		componentParameters: {},
	}

	constructor(options: Object, apiKeyField: ?HTMLInputElement) {
		this.options = Object.assign({}, this.constructor.defaults, options);
		this.apiKeyField = apiKeyField;
	}

	fetch(action: string, payload: Object = {}) : Promise {
		return new Promise((resolve, reject) => {
			const formData = {
				action: action,
				payload: payload,
				componentParameters: this.options.componentParameters,
			};

			if (this.apiKeyField != null)
			{
				formData['apiKey'] = this.apiKeyField.value;
			}

			BX.ajax({
				url: this.options.url,
				method: 'POST',
				dataType: 'json',
				data: formData,
				onsuccess: (data) => {
					if (data.status === 'ok') {
						resolve(data.data);
					} else if (data.status === 'error') {
						reject(new Error(data.message));
					} else {
						reject(new Error('unknown response format'));
					}
				},
				onfailure: (data) => {
					reject(new Error(data.message));
				}
			});
		});
	}
}