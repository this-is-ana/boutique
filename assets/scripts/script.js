document.addEventListener('DOMContentLoaded', () => {
	let components = document.querySelectorAll('[data-js-component]'); 

	for (let component of components) {
		
		let componentDataSet = component.dataset.jsComponent,
			componentElement = component;

		for (let key of Object.keys(classMapping)) {
			if (componentDataSet == key) new classMapping[componentDataSet](componentElement);
		}
	}
})