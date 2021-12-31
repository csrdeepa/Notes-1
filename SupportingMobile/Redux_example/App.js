import React, { Component } from 'react'
import { Text, View, TouchableOpacity } from 'react-native'
import {createStore} from 'redux'
import {Provider} from 'react-redux'
import Comedy from './Comedy'

//Selector
const VADIVELU_COMEDY='VADIVELU_COMEDY'
const GOUNDAMANI_COMEDY='GOUNDAMANI_COMEDY'

//Actions
export const vadiveluComedyAction=()=>({type:'VADIVELU_COMEDY'})
export const goundamaniComedyAction=()=>({type:'GOUNDAMANI_COMEDY'})


//Reducer
const comedyReducer=(state, actions)=>{
    switch(actions.type){
        case 'VADIVELU_COMEDY':
            return state = "121212121"
            // break;
        case 'GOUNDAMANI_COMEDY':
            return state="9999999"
            // break;
        default:
            return state='No comedy'
            // break;
    }
}

//config Reducer in store
let store=createStore(comedyReducer);
store.subscribe(()=>{
   console.log(store.getState());
});

store.dispatch(vadiveluComedyAction());
store.dispatch(goundamaniComedyAction());



export class App extends Component {
    render() {
        return (
            <Provider store={store}>
                <Comedy  />
            </Provider>
        )
    }
}

export default App

// Redux
// -------------
// Action - deleteAction
// Reducer - code implementation
// Store - keep in store (reducer)
// Dispatch - for use ur operation

