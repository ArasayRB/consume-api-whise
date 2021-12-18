import axios from 'axios';
import {GET_TASKS, TASK_ERROR, ADD_TASK, DELETE_TASK} from './types';

/**
* Get Tasks by property
*/
export const getTasks = props => async dispatch =>
{
  try {
    const resp = await axios.get('/dashboard/estates/tasks/list/'+props.propid);
    dispatch({
      type:GET_TASKS,
      payload:resp.data
    })
  } catch (err) {
    dispatch({
      type:TASK_ERROR,
      payload:{
        msg:err.response.statusText,
        status:err.response.status
      }
    })
  }
}

/**
* Add Task
*/
export const addTask = (formData,tasks) => async dispatch => {
    const config = {
        headers: {
            "Content-Type": "application/json"
        }
    };
    try {
        const res = await axios.post("/dashboard/estates/tasks", formData, config);

        dispatch({
            type: ADD_TASK,
            payload: res.data
        });
    } catch (err) {
        dispatch({
            type: TASK_ERROR,
            payload: {
                msg: err.response.statusText,
                status: err.response.status
            }
        });
    }

}

/**
* Delete Task
*/
export const deleteTask = taskId => async dispatch =>
{
    try {
        await axios.delete(`/dashboard/estates/tasks/${taskId}`);
        dispatch({
            type:DELETE_TASK,
            payload:taskId
        })
    } catch (err) {
        dispatch({
            type:TASK_ERROR,
            payload:{
                msg:err.response.statusText,
                status:err.response.status
            }
        })
    }
}
