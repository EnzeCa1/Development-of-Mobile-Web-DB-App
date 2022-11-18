package com.example.mobiledb;

public class Task {
    String taskId;
    String taskName;
    String taskType;

    public Task(){}
    public Task(String taskId, String taskName, String taskType){
        this.taskId=taskId;
        this.taskName=taskName;
        this.taskType=taskType;
    }

    public String getTaskId(){
        return taskId;
    }

    public String getTaskName(){
        return taskName;
    }

    public String getTaskType(){
        return taskType;
    }
}
