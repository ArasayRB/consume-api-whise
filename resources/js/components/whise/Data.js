import React, {useEffect} from 'react';
import ReactDOM from 'react-dom';
import Form from './Form';
import Tasks from './Tasks';
import store from '../../store';
import {Provider} from 'react-redux';
import {getTasks} from '../../actions/task';

const Data = (props)=> {
    useEffect(() => {
      store.dispatch(getTasks(props));
    }, []);
    return (
      <Provider store={store}>
        <div className="py-12">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div className="bg-white p-8 rounded-md w-full">
               <div className=" flex items-center justify-between pb-6">
                 <div>
                   <h1><span className="font-bold">Nombre de la propiedad:</span> {props.propname}</h1>
                   <h3><span className="font-bold">Id:</span> {props.propid}</h3>
                   <p><span className="font-bold">Descripcion:</span> {props.proppurpose} ({props.propstatus})</p>
                 </div>

                 <div className="flex items-center justify-between">
                  <a href="/" className="btn bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" name="button">Regresar al Dashboard</a>
                 </div>
               </div>
               <div className="flex items-center justify-between pb-6">
                 <Form propid={props.propid}/>

                 <Tasks propid={props.propid} propname={props.propname} proppurpose={props.proppurpose} propstatus={props.propstatus}/>
               </div>
             </div>
          </div>
        </div>
      </Provider>
    );
}

export default Data;

if (document.getElementById('data')) {
  // find element by id
   const element = document.getElementById('data')

   // create new props object with element's data-attributes
   const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Data {...props}/>, element);
}
