import './App.css';
import {useState} from "react";

function App()
{
  const [alunni, setAlunni]=useState([]);
  const [loading, setLoading]=useState(false);
  function carica() 
  {
    setLoading(true);
    fetch('http://localhost:8080/alunni')
    .then(response => response.json())
    .then(data => {
      setAlunni(data)
      setLoading(false);
    })
  }

  return(
    <>
    <table border="1">
      {
        alunni.map(alunno =>
          <tr>
            <td>{alunno.id}</td>
            <td>{alunno.nome}</td>
            <td>{alunno.cognome}</td>
          </tr>
        )
      }
    </table>
    {loading &&
      <p>caricamento...</p>
    }
    {alunni.length===0 &&
      <button onClick={carica}>
        carica alunni
      </button>
    }
    </>
  );
}

export default App;
