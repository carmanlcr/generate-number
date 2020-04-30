if($('#postFacebook').length){
    $('#rowCountTotal').hide();
    new Vue({

            el: '#postFacebook',

            created: function(){
                this.getPostUsers();
            },

            data: {
            
                facebook: [],
                tasks_grid_id: null
            },

            methods: {
                getPostUsers: function(){
                    if($('#postFacebook').length){
                        var urlGenerate = '/facebook/post-user';
                    axios.get(urlGenerate)
                    .then(response => {
                        $('#rowHidden').hide();
                        $('#rowCountTotal').show();
                        
                        this.facebook = response.data
                    }).catch(response => {
                        $('#rowHidden').hide();
                        console.log(response);

                    });
                    }
                    
                },

            },
            watch: {
                getWatch: function(){
                    this.getPostUsers();
                }
            }

        
    });
}