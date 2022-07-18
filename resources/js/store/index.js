import Vue from 'vue';
import Vuex from 'vuex';
import Ad from './modules/Ad/index';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules:{
        Ad
    }
});
