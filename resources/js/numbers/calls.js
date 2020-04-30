
if($('#calls').length){
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
				if($('#calls').length){
					var UrlCalls = '/callcenter/call';
				axios.get(UrlCalls)
				.then(response => {
					$('#rowHidden').hide();
					this.calls = response.data
				}).catch(response => {
					console.log(response);

				});
				}
				
			}

		},
	});
}