<template>
    <form @submit.prevent="onSubmitted">
        <div class="form-group">
            <label for="title"> Title </label>
            <input type="text" id="title" class="form-control" v-model="newsTitle">
        </div>
        <div class="form-group">
            <label for="content"> Content </label>
            <input type="text" id="content" class="form-control" v-model="newsContent">
        </div>
        <div class="form-group">
            <label for="language"> Language </label>
            <input type="text" id="language" class="form-control" v-model="newsLanguage">
        </div>
        <button class="btn btn-primary">Click</button>
    </form>
</template>

<script>
    import axios from 'axios';
    export default {
        data(){
            return {
                newsTitle:'',
                newsContent: '',
                newsLanguage: ''
            }
        },
        methods: {
            onSubmitted(){
                axios.post('http://127.0.0.1:8000/api/news/create',
                    {title: this.newsTitle,content: this.newsContent, language: this.newsLanguage})
                    .then(
                        (response) => console.log(response)
                    )
                    .catch(
                        (error) => console.log(error)
                    );

            }
        }
    }
</script>