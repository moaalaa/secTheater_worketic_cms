let user = window.App.user;

module.exports = {
    owns(model, prop = 'creator_id') {
        return model[prop] === user.id;
    },
    isAdmin() {
        return user.type === 'admin';
    }
};