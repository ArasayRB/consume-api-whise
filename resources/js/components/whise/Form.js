import React, { useState } from 'react';
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { addTask } from "../../actions/task";

const Form = ({task: {tasks,loading,propid},addTask}) => {
    const [formData, setFormData] = useState(
      {
        name:"",
        date:"",
        description:"",
        property_id:""
      },
      []
    );

    const {property_id, name, date, description} = formData;

    const onChange = e =>
        setFormData({ ...formData, [e.target.name]: e.target.value });
console.log('Property',propid);
    const onSubmit = e =>
    {
      e.preventDefault();
      formData['property_id']=tasks[0];
      addTask(formData,tasks[0]);
      setFormData({property_id: "", name: "", date: "", description: ""});
    };

    return (
      <div>
       <div className="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
         <div className="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
           <p className="text-3xl font-bold leading-7 text-center">Agregar tarea</p>
           <form onSubmit={e => {
             onSubmit(e);
           }}
           >
             <div className="flex items-center justify-between pb-6">
                     <input type="hidden" name="property_id" />
                 <div>
                     <input type="text" name="name" value={name} className="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" placeholder="Nombre de la tarea" onChange={e => onChange(e)}/>
                 </div>
                 <div>
                     <input type="date" name="date" value={date} className="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" onChange={e => onChange(e)}/>
                 </div>
             </div>
             <div>
                 <div className="w-full flex flex-col mt-8">
                     <textarea type="text" name="description" value={description} className="h-40 text-base leading-none text-gray-900 p-3 focus:oultine-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" placeholder="Descripcion de la tarea" onChange={e => onChange(e)}></textarea>
                 </div>
             </div>
             <div className="flex items-center justify-center w-full mt-4">
                 <button
                     className="btn bg-indigo-600 mt-9 font-semibold leading-none text-white bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none"
                     type="submit"
                     name="action"
                 >
                     Create Task
                 </button>
             </div>
           </form>
         </div>
       </div>
      </div>
    );
}

Form.propTypes = {
  task: PropTypes.object.isRequired,
  addTask: PropTypes.func.isRequired
}

const mapStateToProps = state =>  ({
    task: state.task
})

export default connect(mapStateToProps, { addTask })(Form);
