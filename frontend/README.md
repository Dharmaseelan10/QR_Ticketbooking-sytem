QR Concert Booking System Setup
Prerequisites
Before you begin, ensure that you have the following prerequisites installed on your system:
•	Node.js (version 14 or above)
•	npm (Node.js package manager) or Yarn
To verify the installation, open a terminal or command prompt and run the following commands:
node -v
npm -v
Ensure that Node.js and npm are installed and properly configured.
Installation
1.	Clone the Repository: Clone the QR Concert Booking System repository to your local machine.
git clone <repository-url>
Replace <repository-url> with the URL of the repository.
2.	Backend Setup:
•	Navigate to the backend directory.
•	Install backend dependencies.
cd backend
npm install
•	Set up the MySQL database using the provided SQL schema.
•	Configure the database connection in backend/QRTicket.js and backend/server.js.
•	Start the backend server.
node server.js
3.	Frontend Setup:
•	Navigate to the frontend directory.
•	Install frontend dependencies.
cd ../frontend
npm install
•	Edit components if necessary.
•	Build the frontend application.
npm run build
4.	Serve the Application:
•	Copy the contents of the dist directory generated in the frontend folder.
•	Paste the copied contents into the backend directory, replacing any existing files.
•	Change directory to the backend.
•	Start the backend server to serve the frontend files.
node server.js
5.	Access the Application:
•	Open your web browser and navigate to http://localhost:3000 or the specified port where the backend server is running.
By following these steps, you can set up and run the QR Concert Booking System on your local machine.
