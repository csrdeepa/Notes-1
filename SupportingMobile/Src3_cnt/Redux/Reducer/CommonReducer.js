import * as Actions from '../Types/ActionTypes'

const initialvalue = {
    isConnected_state: false
}

const AuthReducer = (state =initialvalue,action) => {

    switch (action.type){
        case Actions.ISCONNECTED_STATE:
            return {
                isConnected_state: false
            };
 
        default:
            return state;
    }
}
export default AuthReducer;
