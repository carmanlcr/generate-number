

new Vue({

	el: '#calls',

	created: function(){
		this.getCalls();
	},

	data: {
	
		calls: []

	},

	methods: {
		getCalls: function(){
			var UrlCalls = 'call';
			axios.get(UrlCalls)
			.then(response => {
				this.calls = response.data
			});
		}

	},
});