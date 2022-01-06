import { combineReducers, createStore } from 'redux';

import AuthReducer from '../Reducer/AuthReducer'
const AppReducers = combineReducers({
    AuthReducer,

});

const rootReducer = (state, action) => {
	return AppReducers(state,action);
}

let store = createStore(rootReducer);

export default store;