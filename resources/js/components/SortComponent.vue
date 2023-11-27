<template>
    <div>
        <div v-for="comment in sortedComments" :key="comment.id" class="comment">
            <button class="reply-button" @click="openPopup(comment.id)">Ответить</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comments: [
                { id: 1, /* Другие свойства комментария */ },
                { id: 2, /* Другие свойства комментария */ },
                // ...
            ],
            sortBy: 'date',
        };
    },
    computed: {
        sortedComments() {
            // Компьютер для сортировки комментариев
            return this.comments.slice().sort((a, b) => {
                if (this.sortBy === 'date') {
                    // Сортировка по дате
                    return new Date(b.date) - new Date(a.date);
                } else if (this.sortBy === 'likes') {
                    // Сортировка по лайкам
                    return b.likes - a.likes;
                }
            });
        },
    },
    methods: {
        openPopup(commentId) {
        },
    },
};
</script>
