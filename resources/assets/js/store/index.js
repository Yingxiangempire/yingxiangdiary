/**
 * Created by yuxiangwang on 18/4/21.
 */
import state from './state'
import Vuex from 'vuex'
import getters from './getters'
import sidebar from './modules/sidebarMenu'
import head from './modules/head'
Vue.use(Vuex);
const store = new Vuex.Store({
    state,
    getters,
    modules: {
        sidebar,
        head
    }
})
export default store