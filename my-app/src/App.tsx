import React, { useState, useEffect, useCallback } from 'react';
import './App.css';
import axios from 'axios';

function App() {
  const [todo, setTodo] = useState('')
  const [data, setData] = useState<any[]>([])
  const baseUrl = "http://127.0.0.1:8000/api"

  const fetchData = useCallback(async () => {
    const response = await axios.get(`${baseUrl}/todoLists`);
    setData(response.data.data)
  }, [])

  useEffect(() => {
    fetchData()
  }, [fetchData])

  const onSubmit = () => {
    if (todo === '') {
      alert('Empty Todo!')
      return;
    }

    const frmdetails = {
      todo,
      status: 2
    }
    axios.post(`${baseUrl}/create`, frmdetails).then(response => {
        fetchData()
        setTodo('')
    });
  }

  const onComplete = (id: any) => {
    axios.get(`${baseUrl}/complete/${id}`).then(response => {
        fetchData()
    });
  }

  const onRemove = (id: any) => {
    axios.get(`${baseUrl}/remove/${id}`).then(response => {
        fetchData()
    });
  }

  return (
    <div className="App">
        <label>
          Write your TODO: <br/>
          <textarea name="postContent" rows={4} value= {todo} cols={40} onChange={e => setTodo(e.target.value)}/>
        </label>
        <button onClick={onSubmit}>ADD</button>
      <center>
      <table border={1}>
        <thead>
          <tr>
            <th>TODO</th>
            <th>STATUS</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
        {data.length > 0 ? (
          data.map((item) => (
            <tr key={item.id} style={{background: item.status === 1 ? 'green' : 'white' }}>
              <td>{item.todo}</td>
              <td>{item.status === 1 ? 'Completed' : 'Pending'}</td>
              <td><button onClick={() => onComplete(item.id)}>Complete</button>
              <button onClick={() => onRemove(item.id)}>Remove</button></td>
            </tr>
        ))) : ''}
        </tbody>
    </table>
    </center>
    </div>
  );
}

export default App;
