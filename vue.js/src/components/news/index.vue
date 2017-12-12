<template>
    <div>
        <app-new v-for="newek in news" :ns="newek"></app-new>
    </div>
</template>

<script>
    import New from './single';
    import axios from 'axios';

    export default {
        name: "index",
        data() {
            return {
                news: [],
                page: null,
            }
        },
        created: function(){
            this.onGetNews();
        },
        methods: {
            onAddPage(){
                this.page++;
                this.onGetNews();
            },
            onSubstractPage(){
                (this.page <= 2) ? this.page = null : this.page--;
                this.onGetNews();
            },
            onGetNews(){
                var getPageParam = (this.page != null) ? '?page=' + this.page : '';
                axios.get('http://127.0.0.1:8000/api/' + getPageParam)
                    .then(
                        response => {
                            this.news = response.data.news;
                        }
                    )
                    .catch(
                        error => console.log(error)
                    )
            }
        },
        components:{
            'app-new': New
        }
    }
</script>

<style scoped>

</style>