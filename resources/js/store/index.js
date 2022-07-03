import {createStore} from "vuex";
import createPersistedState from "vuex-persistedstate"

export default createStore({
    plugins: [createPersistedState()],
    state: {
        user: null,
        auth_token: null
    },
    mutations: {
        SET_AUTH_TOKEN(state, payload) {
            state.auth_token = payload
        },
        SET_USER(state, payload) {
            state.user = payload
        }
    },
    actions: {
        cleanAuth(context) {
            context.commit('SET_AUTH_TOKEN', null)
            context.commit('SET_USER', null)
        }
    },
})
