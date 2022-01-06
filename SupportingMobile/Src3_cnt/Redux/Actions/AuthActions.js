import { connect } from 'react-redux';
import * as Actions from '../Types/ActionTypes';
import SingInScreen from '../../Screens/Account/SingInScreen'

//Actions
export const login_action = (data) => {   
    return {
      type: Actions.LOGIN_STATE,
      payload: data,  
    }
  
  }
export const logout_action = (data) => {   
    return {
      type: Actions.LOGOUT_STATE,
      payload: data,  
    }
  
  }

// export default connect(mapStateToProps, mapDispatchToProps)(SingInScreen);

// const mapStateToProps = (state) => ({
//     isuserloggedIN: state.AuthReducer.isuserloggedIN
// });

// const mapDispatchToProps = (dispatch) => ({
//     loginstate: () => dispatch({type: Actions.LOGIN_STATE}),
//     logoutstate: () => dispatch({type: Actions.LOGOUT_STATE}),
// });

// export default connect(mapStateToProps, mapDispatchToProps)(SingInScreen);

