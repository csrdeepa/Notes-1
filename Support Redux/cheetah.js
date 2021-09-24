/**************** Index.js */
import React from "react";
import ReactDOM from "react-dom";
import One from "./One";

import {createStore} from 'redux'

// A, R, S, D


const myele = <p>hhhh</p>;
const myele1 = React.createElement("h1", null, "Hi Friends");

const h1 = React.createElement("h1", null, "Hi Friends");
const p = React.createElement("p", null, "Hi Friends P TAG");
const myele2 = React.createElement("h1", null, h1);

const myele3 = React.createElement("h1", null, [h1, p]);

function Header() {
  return <h1>Header</h1>;
}

function Main() {
  return <h1>Main</h1>;
}

function Footer() {
  return <h1>Footer</h1>;
}

// ReactDOM.render(
//   [<Header />, <Main />, <Footer />],
//   document.getElementById("root")
// );

function Inc(){
  return{
    type:"INCREMENT"
  }
}
function Dec(){
  return{
    type:"DECREMENT"
  }
}

function Reducers(state=0, action){
  switch(actio.type){
    case "INCREMENT":
      return state+ action.payload
    case "DECREMENT":
      return state-1 
    default:
      return state
  }
}

let Store=createStore(Reducers);
Store.subscribe(()=> console.log(Store.getState()));

// Store.dispatch(Inc());
// Store.dispatch(Dec());
// Store.dispatch(Dec());
Store.dispatch({type:"INCREMENT", payload:2});


export const User = React.createContext();

function Layout() {
  return (
    <div>
      {/* <Header />
      <Main />
      <Footer /> */}
      {/* <One channel={"Deepa"} /> */}
      {/* <Two channel={"Deepa"} />  */}
      <User.Provider value={"I am from ONEE"}>
        <One />
      </User.Provider>


    </div>
  );
}


ReactDOM.render(<Layout />, document.getElementById("root"));


/********** One.js *******/

import React from 'react'
import Two from './Two';


function One(){
  return(
    <div>
      <h1>Hi One </h1>
      <Two />
    </div>
  )
}

export default One;



/************ One1.js *******/

import React, { Component } from "react";
import "./styles.css";
import MyComponent from "./hoc";

class One extends Component {
  constructor() {
    super();
    this.state = {
      name_state: "Deeps"
    };
    // this.myClick = this.myClick.bind(this);
  }
  myClick = () => {
    this.setState({
      name_state: "dsdsds"
    });
    alert("Hi");
  };
  render() {
    const { name_state } = this.state;
    const { channel } = this.props;
    const myStyle = {
      color: "yellow"
    };
    return (
      <div>
        <h1 style={myStyle} className="App">
          One {channel} {name_state}
        </h1>
        <button onClick={this.myClick}>Click</button>
      </div>
    );
  }
}

class Two extends Component{

  render(){
    return(
      <div>
        <h1>{this.props.count}</h1>
        <button onClick={this.props.func}>Ins</button>
        </div>
    )
  }
}

// function One1(props){
//   return(
//     <p>{props.name}</p>
//   )
// }
export default One;
// export default MyComponent(Two);


/******** Two.js ******/
import React from "react";
import Three from "./Three";

function Two() {
  return (
    <div>
      <h1>Hi Two </h1>
      <Three />
    </div>
  );
}

export default Two;

/******** Three.js ******/
import React, { useContext } from "react";
import {User} from './index'

function Three() {
  const my=useContext(User);
  return (
    <div>
      <h1>Hi Three </h1>
      <h1>{my}</h1>
    </div>
  );
}

export default Three;


/******** hoc.js ******/

import React from "react";

const MyComponent = (ImplementComponent) => {
  class NewComponent extends React.Component {
    constructor() {
      super();
      this.state = {
        count: 0
      };
    }

    myCount = () => {
      this.setState({ count: this.state.count + 1 });
    };

    render() {
      return (
        <ImplementComponent count={this.state.count} func={this.myCount} />
      );
    }
  }
};

