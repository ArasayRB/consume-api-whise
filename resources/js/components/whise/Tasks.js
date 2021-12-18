import React, {useEffect} from 'react';
import {connect} from 'react-redux';
import PropTypes from "prop-types";
import TaskHeader from './TaskHeader';
import TaskItem from './TaskItem';
import {getTasks} from '../../actions/task';

const Tasks = ({task: {tasks,loading,props},getTasks}) => {
  useEffect(() => {
    getTasks(props);
  },[getTasks])
    return  loading ?
            (<div className="progress">
                  <div className="indeterminate"></div>
            </div>)
            :
            (
                  <div className="flex items-center justify-between mr-4">
                    <div className="bg-white p-8 rounded-md w-full">
                      <div>
                        <div className="-mx-4 my-2 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                          <div className="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table className="min-w-full leading-normal">
                              <TaskHeader/>
                              <tbody>
                              {tasks.map(task=>
                              <TaskItem key={task.id} task={task}/>
                                  )}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
              );
}

Tasks.propTypes = {
    task: PropTypes.object.isRequired,
    getTasks:PropTypes.func.isRequired,
}

const mapStateToProps = state =>  ({
    task: state.task
})

export default connect(mapStateToProps, {getTasks})(Tasks);
