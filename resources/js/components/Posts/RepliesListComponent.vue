<template>
    <div class="ml-5">
        <reply-item v-for="reply in repliesList" :key="reply.id" :reply="reply" :comment="comment" :post="post"></reply-item>
    </div>
</template>

<script>
import ReplyItem from './ReplyItemComponent';

export default {
    props: ['replies', 'comment', 'post'],
    components: {
        ReplyItem,
    },
    data() {
        return {
            repliesList: this.replies,
        }
    },
    mounted() {
        window.$Events.$on('new_reply_added', this.addNewReply);
        window.$Events.$on('reply_removed', this.removeReply);
    },
    methods: {
        addNewReply(reply) {
            if (reply.comment_id === this.comment.id) {
                this.repliesList.push(reply);
            }
        },
        removeReply(removedReply) {
            if (removedReply.comment_id === this.comment.id) {
                this.repliesList = this.repliesList.filter(reply => reply.id !== removedReply.id)
            }
        },
    }
}
</script>