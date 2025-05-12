import logo from './logo.svg';
import './App.css';
import {useState} from "react;"

function App()
{
  const [alunni, setAlunni]=useState([]);
  const a = [
    {
      "id": "1",
      "nome": "matteo",
      "cognome": "chardo",
  
    },
    {
      "id": "2",
      "nome": "tommi",
      "cognome": "pizza",
    }
  ];

  function carica() 
  {
    setAlunni(a);
  }
  
  {alunni.lenght===0 &&
    <button onClick="carica">
      carica alunni
    </button>
  }

  

  return(
    <table border="1">
    </table>
    
  )
}



// function App() {
//   return (
//     <div className="App">
//       <header className="App-header">
//         <img src={logo} className="App-logo" alt="logo" />
//         <p>
//           Edit <code>src/App.js</code> and save to reload.
//         </p>
//         <a
//           className="App-link"
//           href="https://reactjs.org"
//           target="_blank"
//           rel="noopener noreferrer"
//         >
//           Learn React
//         </a>
//       </header>
//     </div>
//   );
// }

// export default App;
