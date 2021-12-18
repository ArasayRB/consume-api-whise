import {GET_TASKS, TASK_ERROR, ADD_TASK, DELETE_TASK} from '../actions/types';

const initialState = {
  tasks: [],
  loading: true,
  error: {}
}

export default function(state=initialState, action)
{
  const {type,payload} = action;

  switch (type) {
    case GET_TASKS:
        return{
           ...state,
           tasks:payload,
           loading:false
        }
    case ADD_TASK:
        return{
            ...state,
            tasks: [payload,...state.tasks],
            loading:false
        }
    case DELETE_TASK:
        return{
            ...state,
            tasks: state.tasks.filter(task => task.id!== payload),
            loading:false
        }
    default:
      return state;
  }
}
