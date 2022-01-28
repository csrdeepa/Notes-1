import * as React from 'react';
import { FlatList, StyleSheet, Text, View, Alert } from 'react-native';

export default function FlatList1() {
  const [currentIndex, setCurrentIndex]=React.useState(0)

  const renderItem = ({ item, index }) => (
     <View style={currentIndex == index ? styles.SelectedlistItem : styles.listItem} >
      <Text onPress={()=>setCurrentIndex(index)}> {item.title} </Text>
    </View>
  );

const onPressFunction=()=>{

}
const test=()=>{
    <View style={{ padding: 5 }}>
      <Text onPress={()=>alert(JSON.stringify(item) + "   Index :" + index)}> {item.title} </Text>
      <Text onPress={()=>alert(JSON.stringify(testdata[index]))}> {item.title} </Text>
    </View>
}

  return (
    <View style={{ marginTop: 100 }}>
      <FlatList
        data={testdata}
        renderItem={renderItem}
        keyExtractor={(item) => item.title}
        horizontal
      />
    </View>
  );
}

var testdata = [
  {
    title: 'topNode1',
    list: [
      { id: 11, status: 'node11' },
      { id: 12, status: 'node12' },
      { id: 13, status: 'node13' },
      { id: 14, status: 'node14' },
      { id: 15, status: 'node15' },
      { id: 16, status: 'node16' },
    ],
  },
  {
    title: 'topNode2',
    list: [
      { id: 21, status: 'node21' },
      { id: 22, status: 'node22' },
      { id: 23, status: 'node23' },
      { id: 24, status: 'node24' },
      { id: 25, status: 'node25' },
      { id: 26, status: 'node26' },
    ],
  },
  {
    title: 'topNode3',
    list: [
      { id: 31, status: 'node31' },
      { id: 32, status: 'node32' },
      { id: 33, status: 'node33' },
      { id: 34, status: 'node34' },
      { id: 35, status: 'node35' },
      { id: 36, status: 'node36' },
    ],
  },
  {
    title: 'topNode4',
    list: [
      { id: 31, status: 'node41' },
      { id: 32, status: 'node42' },
      { id: 33, status: 'node43' },
      { id: 34, status: 'node44' },
      { id: 35, status: 'node45' },
      { id: 36, status: 'node46' },
    ],
  },
  {
    title: 'topNode5',
    list: [
      { id: 31, status: 'node51' },
      { id: 32, status: 'node52' },
      { id: 33, status: 'node53' },
      { id: 34, status: 'node54' },
      { id: 35, status: 'node55' },
      { id: 36, status: 'node56' },
    ],
  },
  {
    title: 'topNode6',
    list: [
      { id: 31, status: 'node61' },
      { id: 32, status: 'node62' },
      { id: 33, status: 'node63' },
      { id: 34, status: 'node64' },
      { id: 35, status: 'node65' },
      { id: 36, status: 'node66' },
    ],
  },
];



const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#f2f2f4',
        alignItems: 'center',
    },
    listItem: {
        flexDirection: 'row',
        marginTop: 5,
    },
    SelectedlistItem: {
        flexDirection: 'row',
        marginTop: 5,
        backgroundColor:"green",
        borderBottomWidth:3
    },
 
})
