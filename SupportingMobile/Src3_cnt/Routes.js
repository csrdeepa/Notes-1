import React, { Component } from 'react'
import { Text, View } from 'react-native'
import { NavigationContainer, useNavigation } from '@react-navigation/native'
import { createStackNavigator } from '@react-navigation/stack'
// import { createDrawerNavigator } from '@react-navigation/drawer';

import HomeScreen from './Screens/Main/HomeScreen';
import AuthActions from './Redux/Actions/AuthActions';
import ForgotPassword from './Screens/Account/ForgotPassword';
import LogoutScreen from './Screens/Account/LogoutScreen';

const Stack = createStackNavigator();
// const Drawer = createDrawerNavigator();

// const DrawerNavigator = () => {
//     return (
//       <Drawer.Navigator>
//         <Drawer.Screen name="ForgotPassword" component={ForgotPassword} />
//         <Drawer.Screen name="LogoutScreen" component={LogoutScreen} />
//         <Drawer.Screen name="HomeScreen" component={HomeScreen} />
//       </Drawer.Navigator>
//     );
//   }

function Routes() {
    try {
        return (
            <NavigationContainer>
                <Stack.Navigator >
                    {/* <Stack.Screen name="SplashScreen" component={SplashLoad} options={{ headerShown: false }} /> */}
                    <Stack.Screen name="AuthActions" component={AuthActions} options={{ headerShown: false }} />
                    {/* <DrawerNavigator /> */}
                    <Stack.Screen name="ForgotPassword" component={ForgotPassword}
                        options={{ headerShown: true }}
                    />
                    <Stack.Screen name="LogoutScreen" component={LogoutScreen}
                        options={{ headerShown: true }}
                    />
                    <Stack.Screen name="HomeScreen" component={HomeScreen} options={{ headerShown: false }} />
                </Stack.Navigator>
            </NavigationContainer>
        )
    } catch (error) {

    }
}

export default Routes
