import './App.css';
import {useState} from "react";

function App()
{
  const [alunni, setAlunni]=useState([]);
  const [loading, setLoading]=useState(false);
  const [inserimento, setInserimento]=useState(false);
  const [nome, setNome] = useState ('');
  const [cognome, setCognome] = useState ('');
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
  function salva()
  {
    setInserimento(false);
    setLoading(true);
    fetch('http://localhost:8080/alunni', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({nome: nome, cognome: cognome})
    })
    .then(response => response.json())
    .then(data => {
      // setAlunni(data)
      // setLoading(false);
      carica();
    })

    console.log("nome" + "" + "cognome")
  }
  function elimina(id) {
    const conferma = window.confirm("Sei sicuro di voler eliminare questo alunno?");
    if (!conferma) {
      return; 
    }
    setLoading(true);
    fetch(`http://localhost:8080/alunni/${id}`, { method: 'DELETE' })
      .then(() => {
        carica(); 
      });
  }
  

  return(
    <>
    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cognome</th>
        </tr>
      </thead>
      {
        alunni.map(alunno =>
          <tr key={alunno.id}>
            <td>{alunno.id}</td>
            <td>{alunno.nome}</td>
            <td>{alunno.cognome}</td>
            <td><button onClick={() => elimina(alunno.id)}>delete</button></td>
          </tr>
        )
      }
    </table>

    {loading &&
      <p>caricamento...</p>
    }
    {/* {alunni.length===0 &&
      <button onClick={() => setInserimento(true)}>
        carica alunni
      </button>
    } */}
    {/* <button onClick={carica}> */}
    <button className="Bottone" onClick={() => setInserimento(true)}>
      inserisci alunni
    </button>
    {inserimento && (
      <div> 
        Nome: <input onChange={(e)=> setNome(e.target.value)} type="text" id="nome"/><br/><br/>
        Cognome: <input onChange={(e)=> setCognome(e.target.value)} type="text" id="cognome"/><br/><br/>
        <button onClick={salva}>salva</button>
        <button onClick={() => setInserimento(false)}>annulla</button>
      </div>
      
      
      )}
      
    {loading && <p>caricamento</p>}
      {alunni.length === 0 && !loading && (
        <button className="Bottone" onClick={carica}>
          Carica Alunni
        </button>
      )}

    </>
  )
}

export default App;
