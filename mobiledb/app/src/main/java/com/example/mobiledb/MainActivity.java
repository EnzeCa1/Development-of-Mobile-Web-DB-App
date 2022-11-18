package com.example.mobiledb;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;


public class MainActivity extends AppCompatActivity {

    FirebaseDatabase database = FirebaseDatabase.getInstance();
    DatabaseReference dbRef = database.getReference("tasks");

    EditText editTextTask;
    EditText editTextType;
    Button buttonAddTask;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        editTextTask=(EditText) findViewById(R.id.editTextTask);
        editTextType=(EditText) findViewById(R.id.editTextType);
        buttonAddTask=(Button) findViewById(R.id.buttonAddTask);

        buttonAddTask.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View view){
                addTask();
            }
        });
    }

    private void addTask(){
        String taskname=editTextTask.getText().toString().trim();
        String type=editTextType.getText().toString().trim();

        if (!TextUtils.isEmpty(taskname)){
            String id=dbRef.push().getKey();
            Task task=new Task(id,taskname,type);

            dbRef.child(id).setValue(task);
            Toast.makeText(this,"Task added", Toast.LENGTH_LONG).show();
        }
        else{
            Toast.makeText(this,"Task name needs to be entered",Toast.LENGTH_LONG).show();
        }
    }
}