import React, { Component, useEffect, useState, useRef } from 'react';
import { View, Text, StyleSheet, TouchableOpacity } from 'react-native';

const App = () => {
  const [count, setcount] = useState(0)
  const [pid, setpid] = useState(0)
  const refArray = useRef([]);
  // useEffect(() => {

  // }, [])

  const clicknext=()=>{
    setpid(pid+1)
    // console.log(refArray.current[data[pid].title]);
    console.log(JSON.stringify(refArray.current[data[pid].title]));
    // refArray.current[data[pid].title].current.setNativeProps({
    //   style:{
    //   textDecorationLine: 'underline'
    //   }
    //   })
    // refArray.current[data[pid].title].current.style.backgroundColor = "red"
  }
  function deepSearchByKey(object, originalKey, matches = []) {

    if(object != null) {
        if(Array.isArray(object)) {
            for(let arrayItem of object) {
                deepSearchByKey(arrayItem, originalKey, matches);
            }
        } else if(typeof object == 'object') {

            for(let key of Object.keys(object)) {
                if(key == originalKey) {
                    matches.push(object);
                } else {
                    deepSearchByKey(object[key], originalKey, matches);
                }

            }

        }
    }


    return matches;
}
  return (
    <View style={styles.container}>
      <View>
 
        <View>
          <View style={{ flexDirection: 'row' }}>
            {
              data && (
                data.map((item) => (
                <View style={{padding:5}} onPress={()=>{console.log("fd")}} key={item.title} 
                ref={ref => {
                  refArray.current[item.title] = ref;  
                }}>
                  <Text>{item.title}</Text>
                </View>
                ))
              )
            }
          </View>
          <View>
            <Text>{data[pid].title}</Text>
            {
              data && (
                data[pid].children.map((item) => (<View key={item.id}><Text>{item.id}</Text></View>))
              )
            }
          </View>
          <TouchableOpacity onPress={()=>clicknext()}><Text>Next</Text></TouchableOpacity>
        </View>
      </View>

      {/* <View style={{
        width: '100%', height: '100%', backgroundColor: 'red', position: 'absolute', opacity: 0.5,
        alignItems: 'center', justifyContent: 'center'
      }}>
        <View style={{ width: '50%', height: '50%', backgroundColor: 'lightred', position: 'absolute', opacity: 1 }}>
          <View style={{ width: '50%', height: '50%', backgroundColor: 'lightred', position: 'absolute', opacity: 1 }}>
            <Text>dfdsfdsf</Text>
          </View>
        </View>
      </View> */}

    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f2f2f2',
  },
});

export default App;


var data = [
  {
    title: 'topNode1',
    children: [
      { id: 11, status: 'node11' },
      { id: 12, status: 'node12' },
      { id: 13, status: 'node13' },
      { id: 14, status: 'node14' },
      { id: 15, status: 'node15' },
      { id: 16, status: 'node16' },
    ]
  },
  {
    title: 'topNode2',
    children: [
      { id: 21, status: 'node21' },
      { id: 22, status: 'node22' },
      { id: 23, status: 'node23' },
      { id: 24, status: 'node24' },
      { id: 25, status: 'node25' },
      { id: 26, status: 'node26' },
    ]
  },
  {
    title: 'topNode3',
    children: [
      { id: 31, status: 'node31' },
      { id: 32, status: 'node32' },
      { id: 33, status: 'node33' },
      { id: 34, status: 'node34' },
      { id: 35, status: 'node35' },
      { id: 36, status: 'node36' },
    ]
  }

];
