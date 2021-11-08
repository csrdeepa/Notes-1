import React, { Component } from 'react';
import { View, Text } from 'react-native';

import DeviceInfo from 'react-native-device-info';
 
class DeviceInfo extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }
componentDidMount = () => {
  let appName = DeviceInfo.getApplicationName();
  console.log('getApplicationName :', appName);

  DeviceInfo.getApiLevel().then((apiLevel) => {
        // iOS: ?
        // Android: 25
        // Windows: ?
        console.log('getApiLevel :', apiLevel);
      });
      DeviceInfo.getBatteryLevel().then((batteryLevel) => {
        // 0.759999
        console.log('getBatteryLevel', batteryLevel);

      });
};
 
  render() {
 
    return (
      <View>
        <Text> App </Text>
      </View>
    );
  }
}

export default DeviceInfo;
 
