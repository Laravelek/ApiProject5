import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:mobileproject5/main.dart';
import '../Pagina/Oefeningen.dart';
class UserData {
  static int? userId;
  static String? authToken;
  static String? userEmail;
}
class Loginservice {
  static Future<void> login(BuildContext context, String email, String password) async {
    try {
      final url = 'http://127.0.0.1:8000/api/login';

      final response = await http.post(
        Uri.parse(url),
        headers: {
          'Content-Type': 'application/json',
        },
        body: json.encode({
          'email': email,
          'password': password,
        }),
      );
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        UserData.authToken = data['access_token'];
        print(UserData.authToken);
        UserData.userEmail = email;
        UserData.userId = data['id']['id'];
        print(UserData.userId);
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => ExerciseListWidget()),
        );
      }
      else {
        showDialog(
          context: context,
          builder: (context) =>
              AlertDialog(
                title: Text('login failed'),
                content: Text('try again'),
                actions: [
                  TextButton(
                    onPressed: () {
                      Navigator.pop(context);
                    },
                    child: Text('OK'),
                  ),
                ],
              ),
        );
      }
    } catch (e) {
      print('An error occurred: $e');
      showDialog(
        context: context,
        builder: (context) =>
            AlertDialog(
              title: Text('Error'),
              content: Text('connection error'),
              actions: [
                TextButton(
                  onPressed: () {
                    Navigator.pop(context);
                  },
                  child: Text('OK'),
                ),
              ],
            ),
      );
    }
  }
}