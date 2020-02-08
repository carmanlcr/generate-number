if($('#usersCreate').length){

    new Vue({

        el: '#usersCreate',

            created: function(){
                this.getUsers();
            },

            data: {
            
                users: [],
                pagination: [],
                url: '/api/users_create',
                urlEdit: '',
                search: ''
            },

            computed: {
                filteredEnqueries(){

                    return this.users.filter(user => {
                        return user.full_name.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.password.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.gender.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.password.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.phone.includes(this.search) || 
                        user.vpn.toLowerCase().includes(this.search.toLowerCase());
                    });
                },

            },

            methods: {
                getUsers: function(){
                    if($('#usersCreate').length){
                    axios.get(this.url)
                    .then(response => {
                        $('#rowHidden').hide();
                        this.users = response.data.users.data;
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
                },

            },
            watch: {
                getWatch: function(){
                    this.getUsers();
                }
            }
    });
}