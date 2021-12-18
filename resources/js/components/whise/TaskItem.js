import React from 'react';
import {connect} from 'react-redux';
import {deleteTask} from '../../actions/task';
import PropTypes from 'prop-types';

const TaskItem = ({task:{name,date,description,id},deleteTask}) => {
    return  (
              <tr>
                <td className="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <p className="text-gray-900 whitespace-no-wrap">{name}</p>
                </td>
                <td className="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <p className="text-gray-900 whitespace-no-wrap">{date}</p>
                </td>
                <td className="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <p className="text-gray-900 whitespace-no-wrap">{description}</p>
                </td>
                <td className="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  {id!='0' && <a
                      className="btn text-light bg-red-700 waves-effect waves-light  red darken-3 btn"
                  onClick={()=>deleteTask(id)}
                  >
                      Delete
                  </a>}

                </td>
              </tr>
              );
}

TaskItem.propTypes = {
    deleteTask: PropTypes.func.isRequired,
}

export default connect(null,{deleteTask})(TaskItem);
