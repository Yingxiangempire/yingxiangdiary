import api from '../../api/index'

const state = {
    sidebars: [],
    name:'aa'
}
const getters = {
        sidebars: state => state.sidebars
}
const actions = {
    async fetchSiderbars({commit}, queryStr){
    await api.get(`user/sidebar?query=${queryStr}`).then(response => {
        state.sidebars=response.data;
    }).
    catch(error => {
        Promise.reject(error)
    })
    }
}
const mutations = {}

export default {
    state,
    getters,
    actions,
    mutations
}