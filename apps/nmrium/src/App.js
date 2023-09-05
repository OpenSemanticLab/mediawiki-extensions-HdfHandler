import React from "react";
import {NMRium} from 'nmrium';
/*const App = () => {
  return <NMRium />;
};

export default App;
*/

export async function loadData(file) {
  const response = await fetch(file);
  //checkStatus(response);
  const data = await response.json();
  return data;
}



const changeHandler = (data) => {
  console.log("Change");
  console.log(data);
}

/* let data = [
  {
    "title": "Empty"
  },
  {
    "groupName": "General",
    "children": [
      {
        "file": "https://cheminfo.github.io/nmr-dataset-demo/ethylbenzene/cosy.nmrium",
        "title": "COSY ethylbenzene"
      }
    ]
  }
] */
// { "spectra": [{ "source": { "jcampURL": "https://cheminfo.github.io/nmr-dataset-demo/ethylbenzene/1h.jdx" } }] }//

const urlParams = new URLSearchParams(window.location.search);

const jcampURLParam = urlParams.get('jcampURL'); // e.g."https://cheminfo.github.io/nmr-dataset-demo/ethylbenzene/1h.jdx"
const dataParam = urlParams.get('data');
let data = {spectra: []};

if (jcampURLParam) data = { spectra: [{ source: { jcampURL: jcampURLParam } }] };
if (dataParam) {
  data = JSON.parse(dataParam)
}
// https://docs.nmrium.org/for-developers/using-nmrium#loading-a-nmrium-file-from-url
//let data2 = { spectra: [{ source: { jcampURL: "https://cheminfo.github.io/nmr-dataset-demo/ethylbenzene/1h.jdx" } }] };
//let data3 = { spectra: [{ source: { files: ["https://cheminfo.github.io/nmr-dataset-demo/ethylbenzene/1h.jdx"] } }] };
//let data4 = { spectra: [{ source: { nmriumURL: "https://cheminfo.github.io/nmr-dataset-demo/coffee/coffee.nmrium" } }] };
/* let file = "https://cheminfo.github.io/nmr-dataset-demo/samples.json";
let baseURL = "https://cheminfo.github.io/nmr-dataset-demo/";
loadData(file).then((d) => {
  const _d = JSON.parse(JSON.stringify(d).replaceAll(/\.\/+?/g, baseURL));
  setData(_d);
});*/

function App() {
  return <NMRium 
    data={data}
    onChange={changeHandler}
  />;
} 

/* const fetchData = () => {
  return new Promise(async(resolve, reject)=>{
      const file = `https://cheminfo.github.io/nmr-dataset-demo/samples.json`;
      let baseURL = "https://cheminfo.github.io/nmr-dataset-demo/";
      try{
            const response = await fetch(file);
            const data = await response.json();
            const _d = JSON.parse(JSON.stringify(data).replaceAll(/\.\/+?/g, baseURL));
            function App() {
              return <NMRium 
                data={_d}
                onChange={changeHandler}
              />;
            }
            resolve(App);
       }catch(e){
           reject(e);
       }
  });
}
export default fetchData; */

export default App;