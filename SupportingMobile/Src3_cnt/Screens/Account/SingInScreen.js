import React, { useState, useEffect } from 'react'
import {
  Text, TextInput, View, StyleSheet, TouchableOpacity,
  Alert, Image, ScrollView, Keyboard, Button
} from 'react-native';
import { useNavigation } from '@react-navigation/native'
import auth from "@react-native-firebase/auth";
import AsyncStorage from '@react-native-community/async-storage';
import { GoogleSignin, GoogleSigninButton, statusCodes, } from '@react-native-google-signin/google-signin';
import NetInfo from "@react-native-community/netinfo";
import { Formik } from "formik";
import * as yup from 'yup';
import { Container, formContainer, error_message,TxtInput, align_vh_center } from '../../Utilities/Custom_style';
import { fetchData, onGoogleButtonSignout } from '../../Redux/Callback/userAuth';
const STORAGE_KEY = '@isUserIn'

const SingInScreen = (props) => {
  const navigation = useNavigation();

  const [email, setEmail] = useState('csrdeepa@gmail.com');
  const [password, setPassword] = useState('');
  const [test, setTest] = useState({ value: '', error: '' });

  useEffect(() => {
    NetInfo.fetch().then(state => {
      console.log("Connection type", state.type);
      console.log("Is connected?", state.isConnected);
    });

    fetchData();
    readData();
    // console.log("Valid ", JSON.stringify(props));
  }, [props.isuserloggedIN])

  const readData = async () => {
    try {
      const x = await AsyncStorage.getItem('@isUserIn')
      if (x !== null) {
        navigation.navigate("HomeScreen", { name: "Hi" })
      } else {
        AsyncStorage.setItem('@isUserIn', '')
      }
    } catch (e) {
      alert('Failed to fetch the data from storage')
    }
  }

  const submit = async (values) => {
    Keyboard.dismiss()

    await auth().signInWithEmailAndPassword(values.email, values.password)
      .then(async (res) => {
        var user = res.user.email;
        console.log("Result : ", res);
        if (user == values.email) {
          props.loginstate();
          console.log("Valid ", JSON.stringify(props));
          await AsyncStorage.setItem('@isUserIn', user)
          navigation.navigate("HomeScreen", { name: "Hi" })
        } else {

        }
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
    auth().signInWithCredential(googleCredential)
      .then(async (res) => {
        console.log("Google signin : ", res);
        await AsyncStorage.setItem('@isUserIn', res.user.email)
        await AsyncStorage.setItem('@providerId', res.additionalUserInfo.providerId)
        navigation.navigate("HomeScreen", { name: "Hi" })
      });
  }
  const loginValidationSchema = yup.object().shape({
    email: yup.string()
      .label('Email')
      .email('Enter a valid email')
      .required('Please enter your email address'),
    password: yup.string()
      .label('Password')
      .required('Please enter your password')
      .min(4, 'Password must have at least 4 characters ')
  })
  return (
    <ScrollView contentContainerStyle={{ flexGrow: 1 }} keyboardShouldPersistTaps='handled' >
      <View style={Container}>
        <Image
          style={sty.tinyLogo}
          source={{ uri: 'https://reactnative.dev/img/tiny_logo.png', }}
        />
        <Text style={sty.title}>Login</Text>
        <View style={{ margin: 5 }}>
          {/* <Button
            title="Google Sign-Out"
            onPress={() => onGoogleButtonSignout().then(() => console.log('Signed in with Google12! Signout'))}
          /> */}
        </View>
        <View style={{ backgroundColor: '#fff', width: '75%' }}>
          <View style={{ margin: 5 }}>
            <Button
              title="Google Sign-In"
              onPress={() => onGoogleButtonPress().then(() => console.log('Signed in with Google12!'))}
            />
          </View>
          <Formik
            validationSchema={loginValidationSchema}
            initialValues={{ email: '' }}
            onSubmit={values => submit(values)}
          >
            {({
              handleChange,
              handleBlur,
              handleSubmit,
              values,
              errors,
              isValid,
            }) => (
              <View style={formContainer}>
                <View style={{ justifyContent: 'center', alignItems: 'center' }}>
                  <TextInput
                    name="email"
                    placeholder="Email Address"
                    style={TxtInput}
                    onChangeText={handleChange('email')}
                    onBlur={handleBlur('email')}
                    value={values.email}
                    keyboardType="email-address"
                  />
                  {errors.email &&
                    <Text style={error_message}>{errors.email}</Text>
                  }
                </View>
                <View style={{ justifyContent: 'center', alignItems: 'center' }}>
                  <TextInput
                    name="password"
                    placeholder="Password"
                    style={TxtInput}
                    onChangeText={handleChange('password')}
                    onBlur={handleBlur('password')}
                    value={values.password}
                    secureTextEntry={true}
                  />
                  {errors.password &&
                    <Text style={error_message}>{errors.password}</Text>
                  }
                </View>
                <View style={{ margin: 5, flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' }}>
                  <TouchableOpacity onPress={() => { navigation.navigate("ForgotPassword") }} >
                    <Text>Forgot Password</Text>
                  </TouchableOpacity>
                  <Button
                    onPress={handleSubmit}
                    title="Submit"
                    disabled={!isValid}
                  />
                </View>
              </View>
            )}
          </Formik>

        </View>
      </View>
    </ScrollView>
  )
}

export default SingInScreen


const sty = StyleSheet.create({
  TxtInput: {
    backgroundColor: 'lightgray',
    padding: 10,
    marginVertical: 10,
    justifyContent: 'center',
    width:'100%'
  },
  loginbtn: {
    paddingHorizontal: 10,
    paddingVertical: 5,
    backgroundColor: 'skyblue',
    margin: 5,
    marginBottom: 15
  },
  tinyLogo: {
    width: 50,
    height: 50,
    marginBottom: 25
  },
  title: {
    fontSize: 45,
    marginBottom: 25
  }
})

