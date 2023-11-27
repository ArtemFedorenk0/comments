<template>

    <div>
        <h2>Comments</h2>
        <ul>
            <li v-for="comment in comments" :key="comment.id">
                {{ comment.text }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comments: [],
        };
    },
    mounted() {
        this.fetchComments();
    },
    methods: {
        async fetchComments() {
            try {
                const response = await axios.get('/commentsJson');
                this.comments = response.data.comments;
            } catch (error) {
                console.error('Error fetching comments', error);
            }
        },
    },
};
</script>

<style scoped>
    /* Стили компонента здесь */
</style>
