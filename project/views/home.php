<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        /* Base Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            color: #2d3748;
        }

        header {
            background-color: #2b6cb0;
            color: #fff;
            padding: 1rem;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.75rem;
        }

        header button {
            background-color: #e53e3e;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        header button:hover {
            background-color: #c53030;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2b6cb0;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        thead {
            background-color: #bee3f8;
        }

        th, td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:nth-child(odd) {
            background-color: #f7fafc;
        }

        tbody tr:hover {
            background-color: #e2e8f0;
        }

        a {
            color: #2b6cb0;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #2b6cb0;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2c5282;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            color: #2b6cb0;
        }

        .modal-header button {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #2d3748;
        }

        .modal-header button:hover {
            color: #c53030;
        }

        .modal form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .modal form input {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
        }

        .modal form input:focus {
            border-color: #2b6cb0;
            box-shadow: 0 0 0 1px #2b6cb0;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Management</h1>
        <button onclick="location.href='index.php?action=logout'">Log Out</button>
    </header>

    <main>
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <button onclick="openEditModal('<?php echo $user['id']; ?>', '<?php echo $user['name']; ?>', '<?php echo $user['email']; ?>')">Edit</button>
                            <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button onclick="openAddModal()">Add New User</button>
    </main>

    <!-- Add User Modal -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New User</h3>
                <button onclick="closeModal('addModal')">&times;</button>
            </div>
            <form action="index.php?action=create" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User</h3>
                <button onclick="closeModal('editModal')">&times;</button>
            </div>
            <form action="index.php?action=update" method="post">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="name" id="editName" required>
                <input type="email" name="email" id="editEmail" required>
                <button type="submit">Update User</button>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.add('active');
        }

        function openEditModal(id, name, email) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }
    </script>
</body>
</html>
