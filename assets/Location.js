import React, { useCallback, useEffect, useState } from 'react'
import axios from 'axios';

const apiUrl = 'http://localhost:8000/api/search?lname=';

const Location = () => {

    const [filterText, setText] = useState('');
    const [data, setData] = useState([]);
    const [submited, isSubmited] = useState(false);

    // const handleChange = useCallback((event) => {
    //     setText(event.target.value)
    // })

    const handleSubmit = useCallback((event) => {
        axios.get(`${apiUrl}${filterText}`)
             .then(res => {
                 setData(res.data)
                 isSubmited(true)
             })
             .catch(error => {
      		    console.log(error)
    	     })
        event.preventDefault();
    })

    let search_result = <div></div>;
    if (submited) {
        search_result = <Table data = {data} />;
    }

    // useEffect(() => {
    //     console.log(`Hi filterText = ${filterText}`)
    //     })

    return (
        <div>
              <div className="row">
                  <div className="col-xs-12 col-sm-12 col-md-12">
                      <br/>
                      <h2 className="d-block p-3 bg-secondary text-white">Location Search Page</h2>
                  </div>
              </div>
              <div className="row">
                  <div className="col-xs-12 col-sm-12 col-md-12">
                      <SearchBar filterText={filterText} onChange={(event) => {setText(event.target.value)}} onSubmit={handleSubmit}/>
                  </div>
              </div>
              <div className="row">
                  <div className="col-xs-12 col-sm-12 col-md-12">
                      {search_result}
                  </div>     
              </div>
        </div>
    )
    
}


const SearchBar =  ({
  filterText,
  onChange,
  onSubmit
}) => <form onSubmit={onSubmit} className="form-inline">
  <div className="form-group">
    <input
      type="text"
      value={filterText}
      onChange={onChange}
      className="form-control"
    />
  </div>
  <div className="form-group">
    <button type="submit" className="btn btn-success"><b>Search</b></button>
  </div>
</form>

const Table = ({data}) => <table id="tab" className="table table-striped">
   <thead><tr><th>Id</th><th>Location</th><th>PId</th><th>PName</th></tr></thead>
   <tbody>{data.map((item, i) => <Row key = {i} location = {item}/>)}</tbody>
   </table>

const Row = ({location}) => <tr><td>{location.l_id}</td><td>{location.l_name}</td><td>{location.p_id}</td><td>{location.p_name}</td></tr>

export default Location;
