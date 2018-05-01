
// initial state
const state = {
    heads: {}
}

// getters
const getters = {

}

// actions
const actions = {
    fetchall ({commit}) {
        let val = {
            "rr": "rr",
            "gg": "gg",
            "tt": "tt"
        };
        commit({
            type: 'setHeads',
            val
        })
    },
    updateA ({commit}) {
        let key = "gg"
        let val = "mmmmmmmm"
        commit({
            type: "updateHead",
            key,
            val
        })
    }
}

// mutations
const mutations = {
    setHeads (state, {val}) {
        console.log(val)
        Object.keys(val).map(key => {
            Vue.set(state.heads, key, val[key])
        })
    },
    updateHead (state, {key, val}) {
        Vue.set(state.heads, key, val)
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}
