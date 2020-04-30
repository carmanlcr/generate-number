
if($('#usersFacebook').length){

    new Vue({

        el: '#usersFacebook',

            created: function(){
                this.getUsers();
            },

            data: {
            
                facebook: [],
                pagination: [],
                url: '/api/facebook/users',
                search: ''
            },

            computed: {
                filteredEnqueries(){

                    return this.facebook.filter(user => {
                        return user.username.toLowerCase().includes(this.search.toLowerCase()) || 
                        user.email.toLowerCase().includes(this.search.toLowerCase()) || 
                        user.full_name.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.password.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.phone.includes(this.search) ||
                        user.creator.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.date_of_birth.includes(this.search.toLowerCase()) ||
                        user.vpn.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.categories.toLowerCase().includes(this.search.toLowerCase());
                    });
                }
            },

            methods: {
                getUsers: function(){
                    if($('#usersFacebook').length){
                    axios.get(this.url)
                    .then(response => {
                        $('#rowHidden').hide();
                        this.facebook = response.data.users.data;
                        this.pagination = response.data.users;
                    }).catch(response => {
                        $('#rowHidden').hide();
                        console.log(response);

                    });
                    }
                    
                },

                makePagination(data){
                    let pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url
                    }

                    this.pagination = pagination;
                },

                fetchPaginateUsers(url){
                    this.url = url;
                    this.getUsers();
                }

            },
            watch: {
                getWatch: function(){
                    this.getUsers();
                }
            }
    });
}