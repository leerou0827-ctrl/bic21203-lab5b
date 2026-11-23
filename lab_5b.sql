-- Q1: create database
CREATE DATABASE IF NOT EXISTS Lab_5b;
USE Lab_5b;

-- Q2: create users table
CREATE TABLE users (
    matric VARCHAR(10) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) NOT NULL
);
