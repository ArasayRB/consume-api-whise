import React from 'react';
import ReactDOM from 'react-dom';

function Data() {
    return (
      <div className="py-12">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div className="bg-white p-8 rounded-md w-full">
               <div className=" flex items-center justify-between pb-6">
                 <div>
                   <h1>Nombre de la propiedad</h1>
                   <h3>Id</h3>
                   <p>Descripcion</p>
                 </div>

                 <div className="flex items-center justify-between">
                  <a href="/" className="btn bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" name="button">Regresar al Dashboard</a>
                 </div>
               </div>
               <div className="flex items-center justify-between pb-6">
                 <div id="form">
                 </div>

                 <div id="tasks">
                 </div>
               </div>
             </div>
          </div>
      </div>
    );
}

export default Data;

if (document.getElementById('data')) {
    ReactDOM.render(<Data />, document.getElementById('data'));
}
