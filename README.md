
##  Table of Contents

- [ Overview](#-overview)
- [ Features](#-features)
- [ Project Structure](#-project-structure)
  - [ Project Index](#-project-index)
- [ Getting Started](#-getting-started)
  - [ Prerequisites](#-prerequisites)
  - [ Installation](#-installation)
  - [ Usage](#-usage)
  - [ Testing](#-testing)
- [ Project Roadmap](#-project-roadmap)
- [ Contributing](#-contributing)
- [ License](#-license)
- [ Acknowledgments](#-acknowledgments)



##  Overview

<code>❯ Move adalah aplikasi manajemen pemesanan kendaraan yang dirancang untuk membantu organisasi atau perusahaan mengelola pemesanan kendaraan dengan efisien. Aplikasi ini mendukung proses pemesanan kendaraan, penugasan pengemudi, dan persetujuan booking secara hierarkis. Dengan antarmuka yang user-friendly dan fitur pelaporan, Move mempermudah monitoring kendaraan sekaligus menyediakan laporan yang bisa diekspor ke Excel.</code>

---


##  Features

<code>❯ Hierarchical Approval System
Proses persetujuan booking kendaraan dilakukan secara bertingkat dengan minimal dua level persetujuan.

Vehicle Booking Management
Formulir pemesanan kendaraan yang mencakup pemilihan kendaraan, penugasan pengemudi, dan jadwal pemesanan.

Driver Assignment
Admin dapat dengan mudah menugaskan pengemudi yang tersedia untuk setiap pemesanan kendaraan.

Vehicle Usage Dashboard
Statistik penggunaan kendaraan ditampilkan dalam dashboard yang informatif.

Exportable Booking Reports
Laporan pemesanan kendaraan dapat diunduh dalam format Excel untuk kebutuhan dokumentasi.

Real-Time Status Updates
Pantau status pemesanan kendaraan secara langsung, termasuk status persetujuan ('Pending', 'Approved', atau 'Rejected').</code>

---

##  Project Structure

```sh
└── move/
    ├── BARUUUUUUUU.svg
    ├── activity-log.php
    ├── add-booking.php
    ├── add-driver.php
    ├── add-vehicle.php
    ├── add_vehicle_process.php
    ├── all-driver.php
    ├── all-vehicles.php
    ├── all_booking.php
    ├── app.js
    ├── approve.php
    ├── approver_dashboard.php
    ├── book_vehicle.php
    ├── book_vehicle_process.php
    ├── char1.png
    ├── composer.json
    ├── composer.lock
    ├── db.php
    ├── export-activity-log.php
    ├── finish-booking.php
    ├── index.php
    ├── kendaraan_monitoring (10).sql
    ├── list_vehicles.php
    ├── login.php
    ├── login_process.php
    ├── logoku.jpeg
    ├── logout.php
    ├── newloh.svg
    ├── password_hash.php
    ├── phpinfo.php
    ├── process_booking.php
    ├── readme.md
    ├── reject.php
    ├── select-driver.php
    ├── style.css
    └── vehicle-selection.php

-- phpMyAdmin SQL Dump
-- version 5.2.1





###  Project Index
<details open>
	<summary><b><code>MOVE/</code></b></summary>
	<details> <!-- __root__ Submodule -->
		<summary><b>__root__</b></summary>
		<blockquote>
			<table>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/app.js'>app.js</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/list_vehicles.php'>list_vehicles.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/style.css'>style.css</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/finish-booking.php'>finish-booking.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/add_vehicle_process.php'>add_vehicle_process.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/book_vehicle.php'>book_vehicle.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/reject.php'>reject.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/book_vehicle_process.php'>book_vehicle_process.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/db.php'>db.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/vehicle-selection.php'>vehicle-selection.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/all-vehicles.php'>all-vehicles.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/index.php'>index.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/add-driver.php'>add-driver.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/composer.json'>composer.json</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/add-vehicle.php'>add-vehicle.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/approve.php'>approve.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/add-booking.php'>add-booking.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/all-driver.php'>all-driver.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/activity-log.php'>activity-log.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/all_booking.php'>all_booking.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/kendaraan_monitoring (10).sql'>kendaraan_monitoring (10).sql</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/phpinfo.php'>phpinfo.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/export-activity-log.php'>export-activity-log.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/login.php'>login.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/login_process.php'>login_process.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/logout.php'>logout.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/approver_dashboard.php'>approver_dashboard.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/process_booking.php'>process_booking.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/password_hash.php'>password_hash.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			<tr>
				<td><b><a href='https://github.com/lukiinia/move/blob/master/select-driver.php'>select-driver.php</a></b></td>
				<td><code>❯ REPLACE-ME</code></td>
			</tr>
			</table>
		</blockquote>
	</details>
</details>

---
##  Getting Started

###  Prerequisites

Before getting started with move, ensure your runtime environment meets the following requirements:

- **Programming Language:** PHP
- **Package Manager:** Composer


###  Installation

Install move using one of the following methods:

**Build from source:**

1. Clone the move repository:
```sh
❯ git clone https://github.com/lukiinia/move
```

2. Navigate to the project directory:
```sh
❯ cd move
```

3. Install the project dependencies:


**Using `composer`** &nbsp; [<img align="center" src="https://img.shields.io/badge/PHP-777BB4.svg?style={badge_style}&logo=php&logoColor=white" />](https://www.php.net/)

```sh
❯ composer install
```




###  Usage
Run move using the following command:
**Using `composer`** &nbsp; [<img align="center" src="https://img.shields.io/badge/PHP-777BB4.svg?style={badge_style}&logo=php&logoColor=white" />](https://www.php.net/)

```sh
❯ php {entrypoint}
```


###  Testing
Run the test suite using the following command:
**Using `composer`** &nbsp; [<img align="center" src="https://img.shields.io/badge/PHP-777BB4.svg?style={badge_style}&logo=php&logoColor=white" />](https://www.php.net/)

```sh
❯ vendor/bin/phpunit
```


---
##  Project Roadmap

 Task 1: <strike>Develop Vehicle Booking Form and Save Data to Database.</strike>
 Task 2: <strike>Implement Vehicle Selection with Popup Details.</strike>
 Task 3: <strike>Assign Drivers to Vehicle Bookings.</strike>
 Task 4: <strike>Create Booking Table in all-booking.php with Action Buttons.</strike>
 Task 5: Implement Hierarchical Approval Process for Bookings.
 Task 6: Build Dashboard for Vehicle Usage Statistics.
 Task 7: Add Export to Excel Functionality for Booking Reports.

 

---

##  

 | Username   | Password (hashed)                                           | Role      | Approver Level |
|------------|-------------------------------------------------------------|-----------|----------------|
| admin      | $2y$10$ZWeeV7C47Ct/qjbTUjJJoe9ynUkVsI9eeQ4itGyiLtR524MnSG59y | admin     | NULL           |
| approver1  | $2y$10$zaEPvcjcFVvDFHebX4hvWeBUb5MNQQji/R4WoMxS7AmGnS6EdHrsC | approver  | approver1      |
| approver2  | $2y$10$AUpUGN4MpDBzGx3iqcO7h.oDqErSdZFA9pX7z.RKaCNNqWqSqCRTi | approver  | approver2      |


 

---

##  Contributing

- **💬 [Join the Discussions](https://github.com/lukiinia/move/discussions)**: Share your insights, provide feedback, or ask questions.
- **🐛 [Report Issues](https://github.com/lukiinia/move/issues)**: Submit bugs found or log feature requests for the `move` project.
- **💡 [Submit Pull Requests](https://github.com/lukiinia/move/blob/main/CONTRIBUTING.md)**: Review open PRs, and submit your own PRs.

<details closed>
<summary>Contributing Guidelines</summary>

1. **Fork the Repository**: Start by forking the project repository to your github account.
2. **Clone Locally**: Clone the forked repository to your local machine using a git client.
   ```sh
   git clone https://github.com/lukiinia/move
   ```
3. **Create a New Branch**: Always work on a new branch, giving it a descriptive name.
   ```sh
   git checkout -b new-feature-x
   ```
4. **Make Your Changes**: Develop and test your changes locally.
5. **Commit Your Changes**: Commit with a clear message describing your updates.
   ```sh
   git commit -m 'Implemented new feature x.'
   ```
6. **Push to github**: Push the changes to your forked repository.
   ```sh
   git push origin new-feature-x
   ```
7. **Submit a Pull Request**: Create a PR against the original project repository. Clearly describe the changes and their motivations.
8. **Review**: Once your PR is reviewed and approved, it will be merged into the main branch. Congratulations on your contribution!
</details>

<details closed>
<summary>Contributor Graph</summary>
<br>
<p align="left">
   <a href="https://github.com{/lukiinia/move/}graphs/contributors">
      <img src="https://contrib.rocks/image?repo=lukiinia/move">
   </a>
</p>
</details>

---

##  License

This project is protected under the [SELECT-A-LICENSE](https://choosealicense.com/licenses) License. For more details, refer to the [LICENSE](https://choosealicense.com/licenses/) file.

---

##  Acknowledgments

- List any resources, contributors, inspiration, etc. here.

---
