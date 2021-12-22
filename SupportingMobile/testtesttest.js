import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Image } from 'react-native';
import { GoogleSignin, statusCodes } from '@react-native-google-signin/google-signin';


const App = () => {

  const [visible, setVisible] = useState(false);

  const [getUname, SetGetUname] = useState('');
  const [getImage, SetGetImage] = useState('');

  useEffect(() => {
    GoogleSignin.configure()
  }, []);


  const googleLogin = async () => {
    try {
      await GoogleSignin.hasPlayServices();
      const userInfo = await GoogleSignin.signIn();
      SetGetImage(userInfo.user.photo);
      SetGetUname(userInfo.user.name)
      console.log("User Infor      ", userInfo + "   user    " + JSON.stringify(userInfo.user));
      setVisible(true);
    } catch (error) {
      if (error.code === statusCodes.SIGN_IN_CANCELLED) {
        console.log("SIGN_IN_CANCELLED    ", error);
        // user cancelled the login flow
      } else if (error.code === statusCodes.IN_PROGRESS) {
        console.log("IN_PROGRESS    ", error);
        // operation (f.e. sign in) is in progress already
      } else if (error.code === statusCodes.PLAY_SERVICES_NOT_AVAILABLE) {
        // play services not available or outdated
        console.log("PLAY_SERVICES_NOT_AVAILABLE    ", error);
      } else {
        // some other error happened  
        console.log("ELSE    ", error);
      }
    }
  };

  const getCurrentUserInfo = async () => {
    try {
      const userInfo = await GoogleSignin.signInSilently();
      console.log("User Infor      ", userInfo);
    } catch (error) {
      if (error.code === statusCodes.SIGN_IN_REQUIRED) {
        // user has not signed in yet
        console.log(error);
      } else {
        console.log(error);
        // some other error
      }
    }
  };

  const isSignedIn = async () => {
    const isSignedIn = await GoogleSignin.isSignedIn();
    console.log("User Infor      ", isSignedIn);
  };


  const signOut = async () => {
    try {
      await GoogleSignin.revokeAccess();
      const isSignedIn = await GoogleSignin.signOut();
      setVisible(isSignedIn);
      //  this.setState({ user: null }); // Remember to remove the user from your app's state as well
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <View style={styles.container}>
      <Text>App</Text>

      {getImage == '' ?
        <Image source={{ uri: 'https://www.pngall.com/wp-content/uploads/2016/03/Lion-PNG-Clipart.png' }} style={{ width: 200, height: 200, resizeMode: 'stretch', margin: 5 }} />
        :
        <Image source={{ uri: getImage }} style={{ width: 200, height: 200, resizeMode: 'stretch', margin: 5 }} />
      }

      <Text style={{ fontSize: 18, color: 'white' }}>{getUname}</Text>
      <TouchableOpacity onPress={googleLogin} style={[styles.btn_bg, { marginTop: 10 }]}>
        <Text>Google Login</Text>
      </TouchableOpacity>

      {!visible ?
        <TouchableOpacity onPress={isSignedIn} style={[styles.btn_bg, { marginTop: 10 }]}>
          <Text>SignedIn</Text>
        </TouchableOpacity> :

        <TouchableOpacity onPress={signOut} style={[styles.btn_bg, { marginTop: 10 }]}>
          <Text>signOut</Text>
        </TouchableOpacity>
      }

      <TouchableOpacity onPress={getCurrentUserInfo} style={[styles.btn_bg, { marginTop: 10 }]}>
        <Text>Current User</Text>
      </TouchableOpacity>




    </View>
  );
}


const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#2c3e50',
  },
  btn_bg: {
    padding: 10,
    paddingStart: 20,
    paddingEng: 20,
    backgroundColor: 'green',
    borderRadius: 10
  }
});
export default App;
