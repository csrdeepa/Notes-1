import * as Actions from '../Types/ActionTypes'

const initialvalue = {
    isuserloggedIN: 0
}

const AuthReducer = (state =initialvalue,action) => {
    switch (action.type){
        case Actions.LOGIN_STATE:
            return {
                // ...state,
                isuserloggedIN: 1
            };
        case Actions.LOGOUT_STATE:
            return {
                // ...state,
                isuserloggedIN: 0
            };
        default:
            return state;
    }
}
export default AuthReducer;
