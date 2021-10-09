const { default: Axios } = require("axios");

new Vue({
	el: '#favorite',
	filters: {
		moment: function (date) {
		    return moment(date).format('YYYY/MM/DD HH:mm:ss ')
		}
	},
	data:{
		favorites:[],
	},
	methods:{
		favoriteData(){
			Axios.get('/favoriteData').then((res)=>{
				this.favorites = res.data;
				console.log(this.favorites);
			})
		},
		//お気に入り削除//
        unlike(favorite) {
            Axios.delete('/api/unlike/'+favorite.id).then((res)=>{
                favorite.likes_count -= 1
                this.favoriteData();
            })
		},
	},
	mounted(){
		console.log();
		this.favoriteData();
	}
});

