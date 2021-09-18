export const getters = {
    loggedIn (state) {
        return state.auth.loggedIn
    },
    user (state) {
        return state.auth.user
    }
}

export const actions = {
    async nuxtServerInit ({ commit }, { req }) {
        let name = 'auth._token.local';
        let auth = null
        if (req.headers.cookie) {
            const parts = req.headers.cookie.split(`; ${name}=`);
            let tokenCookieExist = false;
            if (parts.length === 2) {
                tokenCookieExist = parts.pop().split(';').shift();
            }

            if (tokenCookieExist != 'false') {
                try {
                    const {data} = await this.$axios.get(process.env.API_URL + '/api/user', {
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + tokenCookieExist
                            // 'Content-Type': 'application/json'
                        }
                    })
                    auth = data.user // set the data auth
                } catch (err) {
                    console.log(err);
                    auth = null
                }
                // console.log(auth);
            }
        }
        this.$auth.setUser(auth)
    },
}
