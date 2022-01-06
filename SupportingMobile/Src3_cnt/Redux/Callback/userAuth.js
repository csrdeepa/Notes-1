import auth from "@react-native-firebase/auth";
import { firebase, firestore } from '@react-native-firebase/firestore';
import { GoogleSignin, GoogleSigninButton, statusCodes, } from '@react-native-google-signin/google-signin';
import { useNavigation } from '@react-navigation/native'

export const fetchData = async () => {
  await GoogleSignin.hasPlayServices();
  GoogleSignin.configure({
    webClientId: '246650121842-v4n51iq1m0g0355p7dpvkhn07kfadc33.apps.googleusercontent.com',
    offlineAccess: true
  });
}

export const signInWithEmailAndPassword = async (email, password) => {
  await auth().signInWithEmailAndPassword(email, password)
    .then(async (res) => {
      var user = res.user.email;
      return res;
      //   if (user == email) {
      //     props.loginstate();
      //     console.log("Valid ", JSON.stringify(props));
      //     await AsyncStorage.setItem('@save_data', user)
      //     navigation.navigate("HomeScreen", { name: "Jane" })
      //   } else {

      //   }
      // Alert.alert(user);
    })
    .catch((error) => {
      const { code, message } = error;
      console.log("Result : ", message);
    });
}
async function onGoogleButtonPress() {
  const { idToken } = await GoogleSignin.signIn();// Get the users ID token
  const googleCredential = auth.GoogleAuthProvider.credential(idToken);    // Create a Google credential with the token
  return auth().signInWithCredential(googleCredential);    // Sign-in the user with the credential

}
export const resetPassword = email => {
  auth().sendPasswordResetEmail(email)
    .then(function (user) {
      alert('Please check your email...', user)
    }).catch(function (e) {
      console.log(e)
    })
}
export const onGoogleButtonSignout = async () => {
  const navigation = useNavigation();

  console.log('User signed out! sdsadsa')
  await GoogleSignin.revokeAccess();
  await GoogleSignin.signOut()
    .then(() => 
   { 
     console.log('User signed out!')
     navigation.navigate("AuthActions", { name: "Hi" })
    }
    );
}
