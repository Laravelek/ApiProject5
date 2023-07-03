import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:mobileproject5/Services/LoginService.dart';
import 'dart:convert';
class Exercise {
  final int id;
  final String  Naam;
  final String Beschrijving;
  final String Stappen;

  Exercise({
    required this.id,
    required this.Naam,
    required this.Beschrijving,
    required this.Stappen,
  });

  factory Exercise.fromJson(Map<String, dynamic> json) {
    return Exercise(
      id: json['id'],
      Naam: json['Naam'],
      Beschrijving: json['Beschrijving'],
      Stappen: (json['Stappen']),
    );
  }
}
class MijnPrestatie {
  final int id;
  final int OefeningId;
  final int Aantal;
  final int UserId;

  MijnPrestatie({
    required this.id,
    required this.OefeningId,
    required this.Aantal,
    required this.UserId,
  });

  factory MijnPrestatie.fromJson(Map<String, dynamic> json) {
    return MijnPrestatie(
      id: json['id'],
      OefeningId: json['OefeningId'],
      Aantal: json['Aantal'],
      UserId: json['UserId'],
    );
  }
}
class ExerciseListWidget extends StatefulWidget {

  const ExerciseListWidget({Key? key}) : super(key: key);

  @override
  _ExerciseListWidgetState createState() => _ExerciseListWidgetState();
}

class _ExerciseListWidgetState extends State<ExerciseListWidget> {
  List<Exercise> exercises = [];
  List<MijnPrestatie> mijnPrestaties = [];
  int currentTabIndex = 0;

  @override
  void initState() {
    super.initState();
    fetchData();
    fetchMijnPrestaties();
  }

  Future<void> fetchData() async {
    final response = await http.get(
        Uri.parse('http://127.0.0.1:8000/api/oefeningen'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        exercises =
        List<Exercise>.from(jsonData.map((x) => Exercise.fromJson(x)));
      });
    } else {
      // Handle error case
    }
  }

  Future<void> fetchMijnPrestaties() async {
    final userid = UserData.userId; //user1@email.com
    final token = UserData.authToken;//password
    final response = await http.get(
        Uri.parse('http://127.0.0.1:8000/api/mijnprestaties/$userid'),
        headers: {
          'Authorization': 'Bearer $token',
        });
    print('http://127.0.0.1:8000/api/mijnprestaties/$userid' ' and the token Authorization Bearer $token' );
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      print(response.body);
      setState(() {
        mijnPrestaties = List<MijnPrestatie>.from(
            jsonData.map((x) => MijnPrestatie.fromJson(x)));
        print(mijnPrestaties);
      });
    } else {
      // Handle error case
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Exercise List'),
      ),
      body: Column(
        children: [
          Expanded(
            child: IndexedStack(
              index: currentTabIndex,
              children: [
                buildExerciseList(),
                buildMijnPrestatieList(),
              ],
            ),
          ),
        ],
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: currentTabIndex,
        onTap: (index) {
          setState(() {
            currentTabIndex = index;
          });
        },
        items: [
          BottomNavigationBarItem(
            icon: Icon(Icons.list),
            label: 'Exercises',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.history),
            label: 'Mijn Prestaties',
          ),
        ],
      ),
    );
  }

  Widget buildExerciseList() {
    return ListView.builder(
      itemCount: exercises.length,
      itemBuilder: (context, index) {
        final exercise = exercises[index];
        return ListTile(
          title: Text(exercise.Naam),
          onTap: () {
            // Handle onTap action
          },
        );
      },
    );
  }

  Widget buildMijnPrestatieList() {
    return ListView.builder(
      itemCount: mijnPrestaties.length,
      itemBuilder: (context, index) {
        final prestatie = mijnPrestaties[index];
        final oefening = exercises.firstWhere((exercise) =>
        exercise.id == prestatie.OefeningId);
        return ListTile(
          title: Text('Exercise Name: ${oefening.Naam}'),
          subtitle: Text('Aantal: ${prestatie.Aantal}'),
        );
      },
    );
  }
}
