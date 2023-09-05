import React from "react";
//import ReactDOM from "react-dom";
import { createRoot } from 'react-dom/client';
import NMRium from 'nmrium';
import App from "./App";
import "./App.scss";

//const el = document.getElementById("app");

//ReactDOM.render(<App />, el);

// After

const container = document.getElementById('app');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<App tab="home" />);