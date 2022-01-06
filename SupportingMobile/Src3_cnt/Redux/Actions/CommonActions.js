import { connect } from 'react-redux';
import * as Actions from '../Types/ActionTypes';
import SingInScreen from '../../Screens/Account/SingInScreen'

const mapStateToProps = (state) => ({
    isuserloggedIN: state.CommonReducer.isConnected_state
});

const mapDispatchToProps = (dispatch) => ({
    isConnected: () => dispatch({type: Actions.ISCONNECTED_STATE}),
});

export default connect(mapStateToProps, mapDispatchToProps)(SingInScreen);

