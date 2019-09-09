<template>
    <div>
        <comment-item v-for="comment in commentsList" :key="comment.id" :comment="comment" :post="post"></comment-item>
    </div>
</template>

<script>
import CommentItem from './CommentsItemComponent';

export default {
    props: ['comments', 'post'],
    components: {
        CommentItem,
    },
    data() {
        return {
            commentsList: this.comments,
        }
    },
    mounted() {
        window.$Events.$on('new_comment_added', this.addNewComment);
        window.$Events.$on('comment_removed', this.removeComment);
    },
    methods: {
        addNewComment(comment) {
            this.commentsList.push(comment);
        },
        removeComment(removedComment) {
            this.commentsList = this.commentsList.filter(comment => comment.id !== removedComment.id)
        },
    }
}
</script>